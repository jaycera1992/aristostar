import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { EmployeeService } from './../../../_service/employee.service';

@Component({
  moduleId: module.id,
  selector: 'app-employee-list',
  templateUrl: './employee-list.component.html',
  styleUrls: ['./employee-list.component.css']
})

export class EmployeeListComponent implements OnInit {

  @Output() showEditForm = new EventEmitter<any>();

  @Input() employeeArr = [];
  @Input() p: number;
  @Input() switchCase: number;
  @Input() total: number;
  @Input() totalEmployee: number;

  employeeToBeDeletedId: any;

  loadingDelete = false;
  hideHttpServerError = false;
  successMessage = false;

  searchData: any;

  constructor(
    private _router: Router,
    private _employeeService: EmployeeService,
  ) { }

  ngOnInit() {
  }

  addEmployee() {
    this.showEditForm.emit({ 'trigger': 2 });
  }

  editEmployee(data: any, index: any) {
    this.showEditForm.emit({ 'trigger': 3, 'selectedItem': data, 'selectedIndex': index});
  }

  setDeletedCompany(employeeId) {
    this.employeeToBeDeletedId = employeeId;
  }

  deleteEmployee() {
    this.loadingDelete = true;
    
    this._employeeService.deleteEmployee(this.employeeToBeDeletedId).subscribe(
      response => {
        if (response.success === true) {
          this.loadingDelete = false;
          this.successMessage = true;
        } else {
          this.loadingDelete = false;
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      },
      error => {
        if (error.status == 401) {
          this._router.navigate(['/login']);
        } else {
          this.loadingDelete = false;
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      }
    );
  }

  callEvent() {
    this.showEditForm.emit({ 'trigger': 4 });
    setTimeout(() => {
      this.successMessage = false;
      this.loadingDelete = false;
    }, 3000);
  }

  triggerSearch() {
    this.showEditForm.emit({ 'trigger': 5, 'searchItem': this.searchData});
  } 

}
