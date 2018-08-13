import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { MaterialModule } from './../../_module/material/material.module';
import { InputSwitchModule } from 'primeng/inputswitch';
import { SharedComponentModule } from './../../_module/shared-component/shared-component.module';

import { MainComponent } from './../../_secure/main/main.component';

const routes: Routes = [
  { path: '', component: MainComponent }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    MaterialModule,
    InputSwitchModule,
    RouterModule.forChild(routes),

    SharedComponentModule
  ],
  declarations: [
    MainComponent
  ],
  exports: [
    MainComponent
  ]
})
export class MainModule { }
