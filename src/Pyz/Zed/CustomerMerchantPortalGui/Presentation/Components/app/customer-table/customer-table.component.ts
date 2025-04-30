import {ChangeDetectionStrategy, Component, Input, ViewEncapsulation} from '@angular/core';
import {TableConfig} from '@spryker/table';

@Component({
    selector: 'mp-customer-table',
    templateUrl: './customer-table.component.html',
    styleUrls: ['./customer-table.component.less'],
    changeDetection: ChangeDetectionStrategy.OnPush,
    encapsulation: ViewEncapsulation.None,
})
export class CustomerTableComponent {
    @Input() config: TableConfig;
    @Input() tableId?: string;

}
