import './bootstrap';
import 'font-awesome/css/font-awesome.min.css';
import { initializeSidebar } from "./sidebar";
import {initializeSearchModal} from './searchModal';
import { initializeDeleteModal } from './deleteModal';

document.addEventListener('DOMContentLoaded', () => {
    initializeSidebar();
    initializeDeleteModal();
    initializeSearchModal();


});
