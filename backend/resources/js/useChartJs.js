import { Chart, registerables } from "chart.js";
import annotationPlugin from "chartjs-plugin-annotation";
Chart.register(...registerables);
Chart.register(annotationPlugin);
console.log(Chart);
