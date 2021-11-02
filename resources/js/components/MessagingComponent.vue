<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<form>
							<div class="form-group row justify-content-center no-gutters">
								<div class="col-md-11 border rounded g-0" id="conversationBox">
									<message-recieved></message-recieved>
									<message-sent></message-sent>
									<message-sending></message-sending>
									
								</div>
							</div>
							<div class="form-group row justify-content-center">
								<input class="form-control col-md-9" type="text" name="client-message">
								<button class="btn btn-primary mb-2 col-md-2" type="submit">Send</button>
							</div>
							
						</form>
					</div>
				</div>
			</div>	
		</div>
	</div>
</template>

<script>
	export default {
		mounted() {
			console.log('Messaging Component Mounted')
		}
	}
</script>

<style lang="scss">


#conversationBox {
	height: 25vh;
	overflow-y: scroll;
	.received div{
		background-color: lightblue;
	}
	.sending, .sent {
		margin-right: 0px;
	}
	.sending div{
		background-color: lightgray;
	}
	.sent div{
		background-color: lightgreen;
	}
}

</style>