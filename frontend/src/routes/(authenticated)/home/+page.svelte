<script lang="ts">
	import type { PageData } from './$types';
	import AuthenticatedHead from '$lib/components/atom/head/AuthenticatedHead.svelte';
	import Mihiraki from '$lib/components/atom/diary/Mihiraki.svelte';
	export let data: PageData;
</script>

<AuthenticatedHead title="ホーム" slug="/home" description="おかえりなさい" />

<Mihiraki
	zeroDayAgoDiary={data.zeroDayAgoDiary}
	oneDayAgoDiary={data.oneDayAgoDiary}
	twoDayAgoDiary={data.twoDayAgoDiary}
	threeDayAgoDiary={data.threeDayAgoDiary}
/>
