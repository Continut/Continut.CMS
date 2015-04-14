<strong>Showing: </strong> maximum <?= $limit ?> news
<?php for ($i = 1; $i <= $limit; $i++): ?>
<div class="media">
	<div class="media-left">
		<a href="#">
			<img data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjEzLjQ1ODMzMzk2OTExNjIxMSIgeT0iMzIiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTBwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj42NHg2NDwvdGV4dD48L2c+PC9zdmc+" style="width: 64px; height: 64px;" class="media-object" data-src="holder.js/64x64" alt="64x64">
		</a>
	</div>
	<div class="media-body">
		<h4 class="media-heading">News title <?= $i ?></h4>
		<p>The content of the news goes here...</p>
	</div>
</div>
<?php endfor ?>