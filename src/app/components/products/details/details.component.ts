import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ProductService } from '../../../services/product.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-details',
  templateUrl: './details.component.html',
  styleUrls: ['./details.component.css'],
  imports: [CommonModule],
  standalone: true,
})
export class DetailsComponent implements OnInit {
  product: any; 
  pharmacies: any[] = [];

  constructor(
    private route: ActivatedRoute,
    private productService: ProductService,
    private router: Router
  ) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.productService.getProductById(+id).subscribe(
        (data) => {
          this.product = data.data.product;
          this.pharmacies = data.data.pharmacies; 
        },
        (error) => {
          console.error('Error fetching product details:', error);
          alert('Failed to load product details.');
        }
      );
    }
  }

  goBack(): void {
    this.router.navigate(['/products']);
  }
}
