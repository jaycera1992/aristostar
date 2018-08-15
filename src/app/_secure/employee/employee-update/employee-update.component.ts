import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';
import { SelectItem } from 'primeng/api';

import { Employee } from './../../../_class/employee';
import { EmployeeService } from './../../../_service/employee.service';

@Component({
  selector: 'app-employee-update',
  templateUrl: './employee-update.component.html',
  styleUrls: ['./employee-update.component.css']
})
export class EmployeeUpdateComponent implements OnInit {

  companyReference: SelectItem[];

  public employee: Employee;

  @Output() showEditForm = new EventEmitter<any>();

  @Input() companyId : any;
  @Input() selectedItem : any;
  @Input() selectedIndex: number;
  @Input() employeeArr = [];
  @Input() p: number;
  @Input() switchCase: number;
  @Input() total: number;
  @Input() totalEmployee: number;

  hideHttpServerError = false;
  loadingSave = false;
  successMessage = false;
  errorMessage = false;
  
  isActive: any;
  checked: any;

  constructor(
    private _router: Router,
    private _employeeService: EmployeeService
  ) { }

  ngOnInit() {
    this.companyReference = [];
    this.getCompanyReference();

    if (this.selectedItem.is_deleted == 0) {
      this.isActive = 'Active';
      this.checked = true;
    } else {
      this.isActive = 'Inactive';
      this.checked = false;
    }

    this.employee = {
      firstName: this.selectedItem.first_name,
      lastName: this.selectedItem.last_name,
      email: this.selectedItem.email_address,
      designation: this.selectedItem.designation,
      company: this.selectedItem.company_id,
      isActive: this.selectedItem.is_deleted
    };
  }

  cancelUpdateEmployee() {
    this.showEditForm.emit({ 'trigger': 1 });
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

  submitEmployee(formData: Employee) {
    this.loadingSave = true;

    if (this.checked) {
      formData.isActive = 0;
    } else {
      formData.isActive = 1;
    }

    formData.company = this.companyId;

    this._employeeService.updateEmployee(formData, this.selectedItem.employee_id).subscribe(
      response => {
        if (response.success === true) {
          this.successMessage = true;
          setTimeout(() => {
            this.showEditForm.emit({ 'trigger': 4 });
          }, 3000);
        } else {
          this.loadingSave = false;
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
          this.loadingSave = false;
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      }
    );
  }

  changeStatus() {
    if (this.checked) {
      this.isActive = 'Inactive';
      this.employee.isActive = 1;
    } else {
      this.isActive = 'Active';
      this.employee.isActive = 0;
    }

  }
}
