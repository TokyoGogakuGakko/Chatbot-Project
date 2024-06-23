import axios from 'axios';
import Alpine from 'alpinejs'
import dayjs from 'dayjs';
import Autosize from '@marcreichel/alpine-autosize';

window.dayjs = dayjs;

Alpine.plugin(Autosize);

window.Alpine = Alpine

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Alpine.start()
