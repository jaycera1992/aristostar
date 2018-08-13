import { Injectable } from '@angular/core';
import { Http, Response, Headers, URLSearchParams } from '@angular/http';
import 'rxjs/add/operator/map';

import { AppSettings } from '../app.settings';

@Injectable()
export class EmployeeService {

  private _url: string = AppSettings.API_ENDPOINT + 'secure';

  constructor(private _http: Http) { }

  addEmployee(data: any) {
    let params = 'data=' + encodeURIComponent(JSON.stringify(data));
    let headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.post(this._url + '/' + localStorage.getItem('user_id') + '/employee/add', params, { headers: headers })
      .map((response: Response) => response.json());
  }

  getEmployee(offset) {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/employee/' + offset, { headers: headers })
      .map((response: Response) => response.json());
  }

  getCompanyReference() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/company/get-reference', { headers: headers })
      .map((response: Response) => response.json());
  }

}
