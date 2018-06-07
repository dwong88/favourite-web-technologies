import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { AddTechnologyPage } from './add-technology';

@NgModule({
  declarations: [
    AddTechnologyPage,
  ],
  imports: [
    IonicPageModule.forChild(AddTechnologyPage),
  ],
  exports: [
    AddTechnologyPage
  ]
})
export class AddTechnologyPageModule {}
