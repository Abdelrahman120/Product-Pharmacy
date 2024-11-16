import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ProductService } from '../../../services/product.service';
import { FormsModule } from '@angular/forms';
import { NgFor, NgIf } from '@angular/common';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css'],
  standalone: true,
  imports: [FormsModule, NgFor, NgIf],
})
export class ProductsComponent implements OnInit {
  products: any[] = [];
  filteredProducts: any[] = [];
  searchQuery: string = '';
  currentPage: number = 1;
  totalPages: number = 1;

  constructor(private productService: ProductService, private router: Router) {}

  ngOnInit(): void {
    this.loadProducts();
  }

  loadProducts(): void {
    this.productService
      .getProducts(this.currentPage, this.searchQuery)
      .subscribe(
        (response: any) => {
          if (response && response.data) {
            this.products = response.data.data;
            this.totalPages = response.data.last_page;
            this.filterProducts();
          }
          console.log(response.data.data);
        },
        (error) => {
          console.error('Error fetching products:', error);
        }
      );
  }

  search(): void {
    this.currentPage = 1;
    this.filterProducts();
  }

  filterProducts(): void {
    if (!this.searchQuery) {
      this.filteredProducts = this.products;
    } else {
      this.filteredProducts = this.products.filter(
        (product) =>
          product.title
            .toLowerCase()
            .includes(this.searchQuery.toLowerCase()) ||
          product.description
            .toLowerCase()
            .includes(this.searchQuery.toLowerCase())
      );
    }
  }

  reset(): void {
    this.searchQuery = '';
    this.filteredProducts = [];
    this.currentPage = 1;
    this.loadProducts();
  }

  nextPage(): void {
    if (this.currentPage < this.totalPages) {
      this.currentPage++;
      this.loadProducts();
    }
  }

  previousPage(): void {
    if (this.currentPage > 1) {
      this.currentPage--;
      this.loadProducts();
    }
  }

  goToPage(page: number): void {
    if (page >= 1 && page <= this.totalPages) {
      this.currentPage = page;
      this.loadProducts();
    }
  }

  navigateToCreate(): void {
    this.router.navigate(['/products/create']);
  }

  viewDetails(productId: number): void {
    this.router.navigate(['/products', productId]);
  }

  editProduct(productId: number): void {
    this.router.navigate(['/products/edit', productId]);
  }

  deleteProduct(productId: number): void {
    if (confirm('Are you sure you want to delete this product?')) {
      this.productService.deleteProduct(productId).subscribe(() => {
        alert('Product deleted successfully');
        this.loadProducts();
      });
    }
  }
}
