<script lang="ts">
	import 'dayjs/locale/ja';
	import dayjs, { locale, extend } from 'dayjs';
	import relativeTime from 'dayjs/plugin/relativeTime';
	export let dateString: string;
	locale('ja');
	extend(relativeTime);
	const date = dayjs(dateString);
</script>

<div>
	<!-- 見た目の整備は後回し -->
	<p class="text-center">{date.fromNow()}</p>
</div>
