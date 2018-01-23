<template>
  <div id="dp">
        <datepicker :value="ddate" language="ru" @selected="changeData"></datepicker>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker'

export default
{
  name: 'dp',
  components: {Datepicker},
  props:['ddate'],
  methods:{
  	changeData: function (newdate)
  	{
  		this.$emit('changedate', newdate.toLocaleFormat('%Y-%m-%d'))		
  	}
  }
}
</script>