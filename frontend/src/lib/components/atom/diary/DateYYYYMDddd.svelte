<script lang="ts">
	import dayjs from 'dayjs';
	export let dateString: string;
	const date = dayjs(dateString);
</script>

<div>
	<p>
		<!-- 見た目の整備は後回し -->
		<span>{date.format('YYYY')}</span>
		<span>{date.format('M')}</span>
		<span>{date.format('D')}</span>
		<!-- 曜日表示↓ -->
		<span>{date.format('ddd')}</span>
	</p>
</div>
