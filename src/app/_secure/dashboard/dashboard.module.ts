import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { DashboardComponent } from './dashboard.component';
import { AuthGuard } from './../../_common/auth.guard';

const routes: Routes = [
  {
    path: '', canActivate: [AuthGuard], component: DashboardComponent, children: [
      { path: 'users', loadChildren: './../users/users.module#UsersModule' },
      { path: 'company', loadChildren: './../company/company.module#CompanyModule' }
    ]
  }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    RouterModule.forChild(routes)
  ],
  declarations: [
    DashboardComponent
  ]
})
export class DashboardModule { }
