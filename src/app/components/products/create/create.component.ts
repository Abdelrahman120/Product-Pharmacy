import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ProductService } from '../../../services/product.service';
import { FormsModule } from '@angular/forms';
import { NgIf } from '@angular/common';

@Component({
  selector: 'app-create',
  templateUrl: './create.component.html',
  styleUrls: ['./create.component.css'],
  standalone: true,
  imports: [FormsModule, NgIf]
})
export class CreateComponent {
  title: string = '';
  description: string = '';
  price: number | null = null;
  quantity: number | null = null;
  image: File | null = null;
  submitted: boolean = false; 

  constructor(
    private productService: ProductService,
    private router: Router
  ) {}

  addProduct() {
    this.submitted = true; 
    if (this.isValid()) {
      const productData = new FormData();
      productData.append('title', this.title);
      productData.append('description', this.description);
      productData.append('price', this.price!.toString());
      productData.append('quantity', this.quantity!.toString());

      if (this.image) {
        productData.append('image', this.image);
      }

      this.productService.createProduct(productData).subscribe({
        next: (response) => {
          console.log('Product added successfully:', response);
          this.router.navigate(['/products']);
        },
        error: (error) => {
          console.error('Error adding product:', error);
        }
      });
    }
  }

  onFileChange(event: any) {
    const file = event.target.files[0];
    if (file) {
      this.image = file;
    }
  }

  isValid(): boolean {
    return (
      this.title.trim() !== '' &&
      this.description.trim() !== '' &&
      this.price !== null &&
      this.price > 0 &&
      this.quantity !== null &&
      this.quantity > 0
    );
  }

  cancel() {
    this.router.navigate(['/products']);
  }
}
