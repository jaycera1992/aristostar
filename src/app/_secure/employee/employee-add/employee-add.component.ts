import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';
import { SelectItem } from 'primeng/api';

import { Employee } from './../../../_class/employee';
import { EmployeeService } from './../../../_service/employee.service';

@Component({
  moduleId: module.id,
  selector: 'app-employee-add',
  templateUrl: './employee-add.component.html',
  styleUrls: ['./employee-add.component.css']
})
export class EmployeeAddComponent implements OnInit {

  companyReference: SelectItem[];

  public employee: Employee;

  @Output() showEditForm = new EventEmitter<any>();

  @Input() employeeArr = [];
  @Input() p: number;
  @Input() switchCase: number;
  @Input() total: number;
  @Input() totalEmployee: number;

  hideHttpServerError = false;
  loadingSave = false;
  successMessage = false;
  errorMessage = false;

  constructor(
    private _router: Router,
    private _employeeService: EmployeeService
  ) { }

  ngOnInit() {
    this.companyReference = [];
    this.getCompanyReference();

    this.employee = {
      firstName: '',
      lastName: '',
      email: '',
      designation: '',
      company: '',
      isActive: ''
    };
  }

  fromEmit(event: any) {
    let trigger: number;
    trigger = event.trigger;

  }

  cancelAddEmployee() {
    this.showEditForm.emit({ 'trigger': 1 });
  }

  submitEmployee(formData: Employee) {
    this.loadingSave = true;

    this._employeeService.addEmployee(formData).subscribe(
      response => {
        if (response.success === true) {
          this.successMessage = true;
          setTimeout(() => {
             this.showEditForm.emit({ 'trigger': 4 });
          }, 3000);
        } else {
          this.loadingSave = false;
          this.errorMessage = true;
          setTimeout(() => {
            this.errorMessage = false;
          }, 10000);
        }
      },
      error => {
        if (error.status == 401) {
          this._router.navigate(['/login']);
        } else {
          this.loadingSave = false;
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      }
    );
  }

  getCompanyReference() {
    this._employeeService.getCompanyReference().subscribe(
      response => {
        if (response.success === true) {
          for (let i = 0; i < response.data.length; i++) {
            const element = response.data[i];
            this.companyReference.push(
              { value: element.company_id, label: element.company_name }
            );
          }
          console.log(this.companyReference);
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

}
