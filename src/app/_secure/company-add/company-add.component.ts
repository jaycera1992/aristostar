import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { Company } from './../../_class/company';
import { CompanyService } from './../../_service/company.service';

@Component({
  selector: 'app-company-add',
  templateUrl: './company-add.component.html',
  styleUrls: ['./company-add.component.css']
})
export class CompanyAddComponent implements OnInit {

  @Output() showEditForm = new EventEmitter<any>();

  @Input() companyArr = [];
  @Input() p: number;
  @Input() switchCase: number;
  @Input() total: number;
  @Input() totalCompany: number;
  
  public company: Company;

  hideHttpServerError = false;
  loadingSave = false;
  successMessage = false;

  constructor(
    private _router: Router,
    private _companyService: CompanyService,
  ) { }

  ngOnInit() {
    this.company = {
      companyName: '',
      shortName: '',
      companyAddress: '',
      landline: '',
      commission: '',
      website: '',
      contractDate: '',
      repName: '',
      repPosition: '',
      repPhone: '',
      repEmail: ''
    };
  }

  submitCompany(formData: Company) {
    this.loadingSave = true;

    let dateContact: any;
    dateContact = formData.contractDate;

    formData.contractDate = dateContact.getFullYear() + '/' + (dateContact.getMonth() + 1) + '/' + dateContact.getDate();

    this._companyService.addCompany(formData).subscribe(
      response => {
        if (response.success === true) {
          this.successMessage = true;
          setTimeout(() => {
             this.showEditForm.emit({ 'trigger': 4 });
          }, 3000);
        } else {
          this.loadingSave = false;
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
          this.loadingSave = false;
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      }
    );
  }

  cancelAddCompany() {
    this.showEditForm.emit({ 'trigger': 1 });
  }

}
