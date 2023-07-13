import axios from 'axios';
import store from "../store/index";

const baseURL = 'http://localhost:8000/api/v1/';

console.log(store,"store222");
export default axios.create({
  baseURL,
  headers: {
    'Content-Type': 'application/json'
  },
});
