import { registerNgModule } from '@mp/zed-ui';
import { ComponentsModule as ComponentsModuleCore } from '@mp/dashboard-merchant-portal-gui';
import { ComponentsModule } from './app/components.module';

registerNgModule(ComponentsModuleCore);
registerNgModule(ComponentsModule);
