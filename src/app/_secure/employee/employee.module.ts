import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { SharedComponentModule } from './../../_module/shared-component/shared-component.module';

import { EmployeeComponent } from './employee.component';
import { EmployeeAddComponent } from './employee-add/employee-add.component';

import { EmployeeService } from './../../_service/employee.service';
import { EmployeeListComponent } from './employee-list/employee-list.component';
import { EmployeeUpdateComponent } from './employee-update/employee-update.component';

// const routes: Routes = [
//   { path: '', component: EmployeeComponent }
// ];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    // RouterModule.forChild(routes),

    SharedComponentModule
  ],
  declarations: [
    EmployeeComponent,
    EmployeeAddComponent,
    EmployeeListComponent,
    EmployeeUpdateComponent
  ],
  exports: [
    EmployeeComponent
  ],
  providers: [
    EmployeeService
  ]
})
export class EmployeeModule { }