<?php exit; ?>
U3ludGF4UGFyc2luZw==	9	YW5vbnltb3Vz	127.0.0.1	1078822659	
__''PreviousSyntaxParsing''__

저게 중요한 건 아니고-_-;;;

------------

! HTML 태그 파싱 테스트 ''(>= 0.1.-171)''

여기부터는 <b>굵게</b> 나옵니다.

<img src="/tiniwiki/theme/default/logo.png" /> 이미지가 나옵니다. %%%
<img src="/tiniwiki/theme/default/logo.png" width=60 height=35> XHTML에 맞지 않는 경우 자동으로 바뀌어 출력됩니다 (..) %%%
''지금 / 붙이는 것 빼고 다른 처리를 하지 않기 때문에, 위와 같이 ""가 빠졌다거나 checked 속성 같은 거의 처리가 참 환장할 노릇입니다. -_-;''

<img src="/tiniwiki/theme/default/logo.png">토끼군</img> 이런 태그는 당근 불가능합니다. (</img>는 파싱되지 않습니다!)

WikiWord 같은 거의 영향을 받지 않는 지 테스트: <a href='about:blank' style=border:1px title="WikiWordTest: http://nzeo.com/ :)">우히히</a>

지정하지 않은 태그는 파싱되지 않습니다. <ins>앞뒤에 태그가 노출됩니다. 일명 누드 태그 :)</ins>

HTML 태그를 escape하는 방법은 두 가지 있습니다. &lt;b&gt;이렇게 하거나&lt;/b&gt; \<b>이렇게 합니다.\</b>

지금 가장 골때리는 게 block 태그의 처리입니다.
<h2 class="heading">이렇게 한다면 block은 깨지고 맙니다.</h2>
이런 사태를 예방하려면 아무래도 이런 태그들에 대해서 따로 태그 escape 옵션을 주도록 할 필요가 있습니다 (..)

<span style="text-decoration:underline;">마지막 해결 방법: html 플러그인 만들고 범위 줘서 하라고 하게 함 (......)</span>