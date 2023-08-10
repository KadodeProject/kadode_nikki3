<script lang="ts">
	import { Line } from 'svelte-chartjs';
	import {
		Chart as ChartJS,
		Title,
		Tooltip,
		Legend,
		LineElement,
		LinearScale,
		PointElement,
		CategoryScale
	} from 'chart.js';

	ChartJS.register(Title, Tooltip, Legend, LineElement, LinearScale, PointElement, CategoryScale);
	export let data: { [key: string]: number };
	export let title: string;
	const processedData = {
		labels: Object.keys(data),
		datasets: [
			{
				label: '数',
				data: Object.values(data),
				fill: false,
				borderColor: 'rgb(75, 192, 192)',
				tension: 0.1
			}
		],

		options: {
			indexAxis: 'x',
			categoryPercentage: 1.0,
			barPercentage: 1.0,
			responsive: true,
			plugins: {
				legend: {
					display: false
				}
			}
		}
	};
</script>

<h4 class="text-center text-2xl">{title}</h4>
<Line data={processedData} options={{ responsive: true }} />
