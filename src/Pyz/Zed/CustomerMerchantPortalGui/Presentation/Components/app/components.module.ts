import {NgModule} from '@angular/core';
import {WebComponentsModule} from '@spryker/web-components';

import {CustomerTableComponent} from './customer-table/customer-table.component';
import {CustomerTableModule} from './customer-table/customer-table.module';

@NgModule({
    imports: [
        WebComponentsModule.withComponents([
            CustomerTableComponent,
        ]),
        CustomerTableModule,
    ],
})
export class ComponentsModule {
}
