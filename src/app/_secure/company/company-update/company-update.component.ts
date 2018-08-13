import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { Company } from './../../../_class/company';
import { CompanyService } from './../../../_service/company.service';

@Component({
  moduleId: module.id,
  selector: 'app-company-update',
  templateUrl: './company-update.component.html',
  styleUrls: ['./company-update.component.css']
})
export class CompanyUpdateComponent implements OnInit {

  @Output() showEditForm = new EventEmitter<any>();

  @Input() selectedItem : any;
  @Input() selectedIndex: number;
  @Input() companyArr = [];
  @Input() p: number;
  @Input() switchCase: number;
  @Input() total: number;
  @Input() totalCompany: number;

  public company: Company;

  hideHttpServerError = false;
  loadingSave = false;
  successMessage = false;
  isActive: any;
  checked: any;

  constructor(
    private _router: Router,
    private _companyService: CompanyService,
  ) { }

  ngOnInit() {

    const phone = this.selectedItem.phone.replace('+971', '');

    this.company = {
      companyName: this.selectedItem.company_name,
      shortName: this.selectedItem.short_name,
      companyAddress: this.selectedItem.company_address,
      landline: phone,
      website: this.selectedItem.website
    };
  }

  cancelAddCompany() {
    this.showEditForm.emit({ 'trigger': 1 });
  }

  submitCompany(formData: Company) {
    this.loadingSave = true;
  
    this._companyService.updateCompany(formData, this.selectedItem.company_id).subscribe(
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

}
