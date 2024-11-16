import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http'; 
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root',
})
export class ProductService {
  private apiUrl = 'http://127.0.0.1:8000/api/products';

  constructor(private http: HttpClient) {}

  getProducts(page: number, query: string): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}?page=${page}&query=${query}`).pipe(
      map(response => {  
        response.data.data.forEach((product: any) => {
          if (product.image && !product.image.startsWith('http')) {
            product.imageUrl = `${this.apiUrl}/${product.image}`; 
          } else {
            product.imageUrl = product.image; 
          }
        });
        return response;
      })
    );
  }
  
  

  deleteProduct(productId: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/${productId}`);
  }

  getProductById(id: number): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/${id}`);
  }
  
  createProduct(data: FormData): Observable<any> {
    return this.http.post(this.apiUrl, data);
  }
    
  getItemById(id: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/${id}`);
  }

  updateProduct(productId: string | null, formData: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${productId}`, formData);
  }
  
  
}
