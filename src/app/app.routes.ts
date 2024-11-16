import { Routes } from '@angular/router';
import { LandingComponent } from './components/landing/landing.component';
import { ProductsComponent } from './components/products/products/products.component';
import { CreateComponent } from './components/products/create/create.component';
import { DetailsComponent } from './components/products/details/details.component';
import { EditComponent } from './components/products/edit/edit.component';
import { PharmacyListComponent } from './components/pharmacies/pharmacy-list/pharmacy-list.component';
import { PharmacyCreateComponent } from './components/pharmacies/pharmacy-create/pharmacy-create.component';
import { PharmacyEditComponent } from './components/pharmacies/pharmacy-edit/pharmacy-edit.component';
import { PharmacyShowComponent } from './components/pharmacies/pharmacy-show/pharmacy-show.component';

export const routes: Routes = [
  {
    path: '',
    component: LandingComponent,
    title: 'Home',
  },
  { path: 'products', component: ProductsComponent, title: 'Products' },
  {
    path: 'products/create',
    component: CreateComponent,
    title: 'Create Product',
  },
  {
    path: 'products/:id',
    component: DetailsComponent,
    title: 'Product Details',
  },
  {
    path: 'products/edit/:id',
    component: EditComponent,
    title: 'Edit Product',
  },
  { path: 'pharmacies', component: PharmacyListComponent, title: 'Pharmacies' },

  {
    path: 'pharmacies/create',
    component: PharmacyCreateComponent,
    title: 'Create Pharmacy',
  },
  {
    path: 'pharmacies/edit/:id',
    component: PharmacyEditComponent,
    title: 'Edit Pharmacy',
  },
  {
    path: 'pharmacies/:id',
    component: PharmacyShowComponent,
    title: 'Pharmacy Details',
  },
];
