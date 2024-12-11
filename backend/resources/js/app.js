import './bootstrap';
import 'font-awesome/css/font-awesome.min.css';
import { initializeSidebar } from "./sidebar";
import {initializeSearchModal} from './searchModal';

document.addEventListener('DOMContentLoaded', () => {
    initializeSidebar();
    initializeSearchModal();

});
