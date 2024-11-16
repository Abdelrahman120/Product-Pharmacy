import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PharmacyService {
  private apiUrl = 'http://127.0.0.1:8000/api/pharmacies';

  constructor(private http: HttpClient) { }

  getPharmacies(page: number): Observable<any> {
    const params = new HttpParams().set('page', page.toString());
    return this.http.get<any>(this.apiUrl, { params });
  }

  getPharmacyById(id: number): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/${id}`);
  }

  deletePharmacy(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`);
  }

  addPharmacy(data: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, data);
  }

  updatePharmacy(id: number, data: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}`, data);
  }
}
