import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { PharmacyService } from '../../../services/pharmacy.service';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-pharmacy-create',
  templateUrl: './pharmacy-create.component.html',
  styleUrls: ['./pharmacy-create.component.css'],
  standalone: true,
  imports: [FormsModule]
})
export class PharmacyCreateComponent {
  name: string = '';
  address: string = '';

  constructor(
    private pharmacyService: PharmacyService,
    private router: Router
  ) {}

  addPharmacy(): void {
    if (this.name && this.address) {
      const newPharmacy = {
        name: this.name,
        address: this.address
      };

      this.pharmacyService.addPharmacy(newPharmacy).subscribe({
        next: (response) => {
          console.log('Pharmacy added successfully:', response);
          this.router.navigate(['/pharmacies']);
        },
        error: (error) => {
          console.error('Error adding pharmacy:', error);
        }
      });
    }
  }

  cancel(): void {
    this.router.navigate(['/pharmacies']);
  }
}
