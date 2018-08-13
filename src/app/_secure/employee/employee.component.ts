import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { EmployeeService } from './../../_service/employee.service';

@Component({
  moduleId: module.id,
  selector: 'app-employee',
  templateUrl: './employee.component.html',
  styleUrls: ['./employee.component.css']
})
export class EmployeeComponent implements OnInit {

  crudTransaction: number;

  p = 1;

  total = 0;
  totalEmployee = 0;

  selectedIndex: number;
  selectedItem: any;

  employeeArr = [];

  hideHttpServerError = false;

  constructor(
    private _router: Router,
    private _employeeService: EmployeeService,
  ) { }

  ngOnInit() {
    this.crudTransaction = 1;
    this.getEmployee(this.p);
  }

  getEmployee(page) {
    this._employeeService.getEmployee(page).subscribe(
      response => {
        if (response.success === true) {
          this.employeeArr = response.data;
        }
      },
      error => {
        if (error.status == 401) {
          this._router.navigate(['/login']);
        } else {
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }  
      }
    );
  }

  fromEmit(event: any) {
    let trigger: number;
    trigger = event.trigger;

    if (trigger == 1) {
      this.crudTransaction = 1;
    } else if (trigger == 2) {
      this.crudTransaction = 2;
    } else if (trigger == 3) {
      this.crudTransaction = 3;

      this.selectedIndex = event.selectedIndex;
      this.selectedItem = event.selectedItem;

    } else if (trigger == 4) {
      this.crudTransaction = 1;
      this.p = 1;
      this.total = 0;
      this.getEmployee(this.p);
    }
  }


}
