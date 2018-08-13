import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { CompanyService } from './../../_service/company.service';

@Component({
  moduleId: module.id,
  selector: 'app-company',
  templateUrl: './company.component.html',
  styleUrls: ['./company.component.css']
})
export class CompanyComponent implements OnInit {

  crudTransaction: number;

  p = 1;

  total = 0;
  totalCompany = 0;
  totalDeletedCompany = 0;
  totalActiveCompany = 0;

  selectedIndex: number;
  selectedItem: any;

  companyArr = [];
  
  hideHttpServerError = false;

  constructor(
    private _router: Router,
    private _companyService: CompanyService,
  ) { }

  ngOnInit() {
    this.crudTransaction = 1;
    this.getCompany(this.p);
  }

  fromEmit(event: any) {
    let trigger: number;
    trigger = event.trigger;

    if (trigger == 1) {
      this.crudTransaction = 1;
    } else if (trigger == 2) {
      this.crudTransaction = 2;
    } else if (trigger == 3) {
      this.crudTransaction = 3;

      this.selectedIndex = event.selectedIndex;
      this.selectedItem = event.selectedItem;
      
    } else if (trigger == 4) {
      this.crudTransaction = 1;
      this.p = 1;
      this.total = 0;
      this.getCompany(this.p);
    }
  }

  getCompany(page) {
    this._companyService.getCompany(page).subscribe(
      response => {

        if (response.success === true) {
          this.companyArr = response.data;
          this.getTotal();
          this.getActiveTotal();
          this.getDeletedTotal();
          // this.getTotalStaff();
        } else {
        
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

  getTotal() {
    this._companyService.getTotal().subscribe(
      response => {
        if (response.success === true) {
          this.totalCompany = response.data.total;
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

  getDeletedTotal() {
    this._companyService.getDeletedTotal().subscribe(
      response => {
        if (response.success === true) {
          this.totalDeletedCompany = response.data.total;
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

  getActiveTotal() {
    this._companyService.getActiveTotal().subscribe(
      response => {
        if (response.success === true) {
          this.totalActiveCompany = response.data.total;
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

}
