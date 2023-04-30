<script>
	import GuestHead from '$lib/components/atom/head/GuestHead.svelte';
</script>

<GuestHead title="ログイン" slug="/login" description="ログインページ" />
<form method="post" action="?/login">
	<label class="block text-sm">
		<span class="text-gray-700 dark:text-gray-400">Email</span>
		<input
			name="email"
			type="email"
			class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
			placeholder="Jane Doe"
		/>
	</label>
	<label class="block mt-4 text-sm">
		<span class="text-gray-700 dark:text-gray-400">Password</span>
		<input
			name="password"
			class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
			placeholder="***************"
			type="password"
		/>
	</label>

	<!-- You should use a button here, as the anchor is only used for the example  -->
	<button
		type="submit"
		class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
	>
		Log in
	</button>
</form>
