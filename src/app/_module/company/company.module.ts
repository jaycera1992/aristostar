import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { MaterialModule } from './../../_module/material/material.module';
import { SharedComponentModule } from './../../_module/shared-component/shared-component.module';
import { CalendarModule } from 'primeng/calendar';

import { CompanyComponent } from './../../_secure/company/company.component';
import { CompanyAddComponent } from './../../_secure/company-add/company-add.component';
import { CompanyListComponent } from './../../_secure/company-list/company-list.component';

import { CompanyService } from './../../_service/company.service';

const routes: Routes = [
  { path: '', component: CompanyComponent }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    MaterialModule,
    CalendarModule,
    RouterModule.forChild(routes),

    SharedComponentModule
  ],
  declarations: [
    CompanyComponent,
    CompanyAddComponent,
    CompanyListComponent
  ],
  exports: [
    CompanyComponent
  ],
  providers: [
    CompanyService
  ]
})
export class CompanyModule { }
