import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { CompanyService } from './../../../_service/company.service';

@Component({
  moduleId: module.id,
  selector: 'app-company-list',
  templateUrl: './company-list.component.html',
  styleUrls: ['./company-list.component.css']
})
export class CompanyListComponent implements OnInit {

  @Output() showEditForm = new EventEmitter<any>();

  @Input() companyArr = [];
  @Input() p: number;
  @Input() switchCase: number;
  @Input() total: number;
  @Input() totalCompany: number;

  companyToBeDeletedId : any;
  loadingDelete = false;
  hideHttpServerError = false;
  successMessage = false;

  constructor(
    private _router: Router,
    private _companyService: CompanyService,
  ) { }

  ngOnInit() {
  }

  addCompany() {
    this.showEditForm.emit({ 'trigger': 2 });
  }

  setDeletedCompany(companyId) {
    this.companyToBeDeletedId = companyId;
  }

  editCompany(data: any, index: any) {
    this.showEditForm.emit({ 'trigger': 3, 'selectedItem': data, 'selectedIndex': index});
  }

  deleteCompany() {
    this.loadingDelete = true;
    
    this._companyService.deleteCompany(this.companyToBeDeletedId).subscribe(
      response => {
        if (response.success === true) {
          this.loadingDelete = false;
          this.successMessage = true;
        } else {
          this.loadingDelete = false;
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      },
      error => {
        if (error.status == 401) {
          this._router.navigate(['/login']);
        } else {
          this.loadingDelete = false;
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      }
    );
  }

  callEvent() {
    this.showEditForm.emit({ 'trigger': 4 });
    setTimeout(() => {
      this.successMessage = false;
      this.loadingDelete = false;
    }, 3000);
  }

}
