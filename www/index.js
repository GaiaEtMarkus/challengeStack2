import BrowserRouter from "./components/BrowserRouter.js";
import routes from "./routes.js";

console.log('ok');

const root = document.getElementById("root");
BrowserRouter(routes, root);
