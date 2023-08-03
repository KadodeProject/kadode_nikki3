<script lang="ts">
	import type { OsiraseType } from '$lib/types/Osirase';
	export let osirase: OsiraseType;
	import InterfaceTimeClockHand from '$lib/assets/icon/interface-time-clock-hand.svg?component';
	import dayjs from 'dayjs';
	const date = dayjs(osirase.date);
</script>

<div class="px-4 mb-12">
	<div class="flex items-center">
		<div class="w-2 h-8 bg-kn_3" />
		<h2 class="ml-2 text-2xl">{osirase.title}</h2>
	</div>
	<p class="flex items-center pt-2">
		<InterfaceTimeClockHand width="20" height="20" />
		<span class="pl-2">
			{date.format('YYYY年M月D日(ddd)')}
		</span>
	</p>
	<p class="flex items-center pt-2" />
	<div class="py-4">
		<p>{osirase.description}</p>
	</div>
</div>
