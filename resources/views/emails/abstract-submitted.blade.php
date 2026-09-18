<h1>Abstract submission received</h1>

<p>Hello {{ $submission->user->name }},</p>

<p>We have received your abstract and it is now under initial review.</p>

<table cellpadding="6" cellspacing="0" border="0">
    <tr><th align="left">Title</th><td>{{ $submission->title }}</td></tr>
    <tr><th align="left">Author</th><td>{{ $submission->author }}</td></tr>
    <tr><th align="left">Track</th><td>{{ $submission->track }}</td></tr>
    <tr><th align="left">Status</th><td>{{ $submission->status }}</td></tr>
</table>

<p>We will email you when there is an update.</p>
