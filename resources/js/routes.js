import dash from './components/Pages/dash.vue';
import sections from './components/Pages/sections.vue';
import secondSection from './components/Pages/secondSection.vue';
import country from './components/Pages/country.vue';
import cv from './components/Pages/cv.vue';
import orders from './components/Pages/orders.vue';
import ssform from './components/Pages/ssform.vue';


export const routes = [
	{
		path:'/',
		name:'dash',
		component:dash
	},
	{
		path:'/sections',
		name:'sections',
		component:sections
	},
	{
		path:'/secondSection',
		name:'secondSection',
		component:secondSection
	},
	{
		path:'/country',
		name:'country',
		component:country
	},
	{
		path:'/cv',
		name:'cv',
		component:cv
	},
	{
		path:'/orders',
		name:'orders',
		component:orders
	},
	{
		path:'/ssform',
		name:'ssform',
		component:ssform
	}
];