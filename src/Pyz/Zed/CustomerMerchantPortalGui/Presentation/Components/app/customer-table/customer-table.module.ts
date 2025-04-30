import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {CustomerTableComponent} from './customer-table.component';
import {TableModule} from '@spryker/table';


@NgModule({
    declarations: [
        CustomerTableComponent
    ],
    imports: [
        CommonModule,
        TableModule
    ]
})
export class CustomerTableModule {
}
