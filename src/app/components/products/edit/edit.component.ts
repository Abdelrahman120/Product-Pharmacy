import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ProductService } from '../../../services/product.service';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.css'],
  standalone: true,
  imports: [FormsModule],
})
export class EditComponent implements OnInit {
  productId: string | null = '';
  title: string = '';
  description: string = '';
  price: number = 0;
  quantity: number = 0;
  image: File | null = null;

  constructor(
    private productService: ProductService,
    private route: ActivatedRoute,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.productId = this.route.snapshot.paramMap.get('id');

    if (this.productId) {
      this.productService
        .getProductById(parseInt(this.productId))
        .subscribe((product) => {
          this.title = product.title;
          this.description = product.description;
          this.price = product.price;
          this.quantity = product.quantity;
        });
    }
  }

  updateProduct() {
    const formData: any = {
      title: this.title,
      description: this.description,
      price: this.price,
      quantity: this.quantity,
    };
  
    if (this.image) {
      const reader = new FileReader();
      reader.onloadend = () => {
        formData.image = reader.result?.toString();  
  
        this.productService.updateProduct(this.productId, formData).subscribe(
          (response) => {
            if (response.success) {
              this.router.navigate(['/products']);
            }
          },
          (error) => {
            console.error("Error updating product:", error);
          }
        );
      };
      reader.readAsDataURL(this.image);  
    } else {
      this.productService.updateProduct(this.productId, formData).subscribe(
        (response) => {
          if (response.success) {
            this.router.navigate(['/products']);
          }
        },
        (error) => {
          console.error("Error updating product:", error);
        }
      );
    }
  }
  
  onFileChange(event: any) {
    const file = event.target.files[0];
    if (file) {
      this.image = file;
    }
  }

  cancel() {
    this.router.navigate(['/products']);
  }
}
