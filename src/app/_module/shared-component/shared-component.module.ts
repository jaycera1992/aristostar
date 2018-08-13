import { NgModule } from '@angular/core';
import { HttpModule, Http } from '@angular/http';
import { CommonModule } from '@angular/common';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { Router, RouterModule } from '@angular/router';

import { HttpErrorComponent } from './../../_public/http-error/http-error.component';
import { NgxPaginationModule } from 'ngx-pagination';
import { MaterialModule } from './../../_module/material/material.module';
import { InputSwitchModule } from 'primeng/inputswitch';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    CommonModule,
    HttpClientModule,
    RouterModule,
    NgxPaginationModule,
    MaterialModule,
    InputSwitchModule
  ],
  declarations: [
    HttpErrorComponent
  ],
  exports: [
    HttpErrorComponent,
    NgxPaginationModule
  ]
})
export class SharedComponentModule { }
