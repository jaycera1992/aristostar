import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { MaterialModule } from './../../_module/material/material.module';

import { DashboardComponent } from './../../_secure/dashboard/dashboard.component';
import { AuthGuard } from './../../_common/auth.guard';

const routes: Routes = [
  {
    path: '', canActivate: [AuthGuard], component: DashboardComponent, children: [
      { path: 'main', loadChildren: './../../_module/main/main.module#MainModule' },
      { path: 'users', loadChildren: './../../_module/users/users.module#UsersModule' },
      { path: 'booking', loadChildren: './../../_module/booking/booking.module#BookingModule' },
      { path: 'company', loadChildren: './../../_module/company/company.module#CompanyModule' }
    ]
  }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    MaterialModule,
    RouterModule.forChild(routes)
  ],
  declarations: [
    DashboardComponent
  ]
})
export class DashboardModule { }
