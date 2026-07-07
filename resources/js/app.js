import './bootstrap';

import './checkout/index';

import './products/variants';

import './dashboard/index';

// Pagamentos
import './payments/pix';
import './payments/card';
import './payments/boleto';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start()
