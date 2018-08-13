import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { SharedComponentModule } from './../../_module/shared-component/shared-component.module';
import { CalendarModule } from 'primeng/calendar';

import { CompanyComponent } from './company.component';
import { CompanyAddComponent } from './company-add/company-add.component';
import { CompanyListComponent } from './company-list/company-list.component';
import { CompanyUpdateComponent } from './company-update/company-update.component';

import { CompanyService } from './../../_service/company.service';


const routes: Routes = [
  { path: '', component: CompanyComponent }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    CalendarModule,
    RouterModule.forChild(routes),

    SharedComponentModule
  ],
  declarations: [
    CompanyComponent,
    CompanyAddComponent,
    CompanyListComponent,
    CompanyUpdateComponent
  ],
  exports: [
    CompanyComponent
  ],
  providers: [
    CompanyService
  ]
})
export class CompanyModule { }
