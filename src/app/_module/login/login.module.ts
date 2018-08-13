import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { MaterialModule } from './../../_module/material/material.module';
import { SharedComponentModule } from './../../_module/shared-component/shared-component.module';

import { LoginComponent } from './../../_public/login/login.component';

const routes: Routes = [
  { path: '', component: LoginComponent }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    MaterialModule,
    RouterModule.forChild(routes),

    SharedComponentModule
  ],
  declarations: [
    LoginComponent
  ],
  exports: [
    MaterialModule
  ]
})
export class LoginModule { }
