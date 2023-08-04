<script lang="ts">
	import AuthenticatedHead from '$lib/components/atom/head/AuthenticatedHead.svelte';
	import HomeHeading from '$lib/components/atom/heading/HomeHeading.svelte';
	import PageHeading from '$lib/components/atom/heading/PageHeading.svelte';
	import ArchiveSettingWrapper from '$lib/components/atom/wrapper/ArchiveSettingWrapper.svelte';
	import type { PageData } from './$types';
	export let data: PageData;
</script>

<AuthenticatedHead title="アーカイブ" description="過去の日記をみるばしょ" />
<PageHeading title="アーカイブ" />
<div class="flex flex-col justify-center p-4 m-2 mt-4 mb-12 border md:flex-row border-blue">
	<ArchiveSettingWrapper title="ソート">新しいものから 古いものから</ArchiveSettingWrapper>
	<ArchiveSettingWrapper title="表示形式">大　中　小</ArchiveSettingWrapper>
	<ArchiveSettingWrapper title="期間">今月 先月 指定</ArchiveSettingWrapper>
</div>
