import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { MaterialModule } from './../../_module/material/material.module';
import { SharedComponentModule } from './../../_module/shared-component/shared-component.module';

import { UsersComponent } from './../../_secure/users/users.component';
import { UsersListComponent } from './../../_secure/users-list/users-list.component';
import { UsersAddComponent } from './../../_secure/users-add/users-add.component';
import { UsersUpdateComponent } from './../../_secure/users-update/users-update.component';
import { DropdownModule } from 'primeng/dropdown';

import { AuthGuard } from './../../_common/auth.guard';

import { UsersService } from './../../_service/users.service';


const routes: Routes = [
  { path: '', component: UsersComponent }
];


@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    MaterialModule,
    RouterModule.forChild(routes),
    DropdownModule,

    SharedComponentModule
  ],
  declarations: [
    UsersComponent,
    UsersListComponent,
    UsersAddComponent,
    UsersUpdateComponent
  ],
  exports: [
    UsersComponent
  ],
  providers: [
    UsersService
  ]
})
export class UsersModule { }

