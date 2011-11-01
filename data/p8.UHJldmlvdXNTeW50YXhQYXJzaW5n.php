<?php exit; ?>
UHJldmlvdXNTeW50YXhQYXJzaW5n	8	YW5vbnltb3Vz	127.0.0.1	1079273999	
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

! 한 번 더 WikiWord 테스트 ''(ONLY 0.1.-180/beta14)''

{{
TiniWiki`AlphaBet -- 둘 다 링크
TiniWiki``AlphaBet -- 뒤에 링크 안 됨
`TiniWiki`AlphaBet -- 앞에 링크 안 됨
$`AlphaBet -- 링크 안 됨 (0.1.-180 전까지는 링크가 되었었다...)
}}

! heading 테스트 ''(>= 0.1.-197)''

!! 둘 (하나는 이미 위에 있지?-_-;)
!!! 셋: 이건 h3 태그에 대응된다.
!!!! 넷: 이건 h4 태그에 대응된다.
!!!!! 다섯: 이건 h5 태그에 대응된다.
!!!!!! 여섯: 이건 h6 태그에 대응된다. 더 있을 턱이 없다;

:)

! link에서의 anchor 테스트 ''(>= 0.1.-201)''

[락매니아|토끼군] %%%
[[토끼집|http://tokigun.net/]] %%%
[[토끼집|tokigun.net]] %%%
[하나\|둘|셋\|넷] %%%
[하나\\|둘|셋\\|넷] %%%
[토끼군|wikiXnet:토끼군]

본의아니게 생긴 feature: [토끼군__바보다__그리고|토끼군]

! netlink 테스트 ''(>= 0.1.-209)''

http://tokigun.net/ %%%
http://tokigun.net/index.php?quote=1&temp=3 %%%
`http://tokigun.net/ %%%
[[http://tokigun.net/]] %%%
[[tokigun.net/]] %%%
[[tokigun.net]] %%%
보너스: http://tokigun.net/`quote/temp

http://tokigun.net/http://moogi.new21.org/ -- 이어져서 링크 %%%
http://tokigun.net/`http://moogi.new21.org/ -- 따로 링크 %%%
`http://tokigun.net/`http://moogi.new21.org/ -- 뒤에만 링크 %%%
http://tokigun.net/``http://moogi.new21.org/ -- 앞에만 링크

! 인터위키 테스트 ''(>= 0.1.-219)''

[test:wiki] [alpha:beta] [alpha\:beta] [alpha\:beta:theta\:gamma] %%%
[alpha:토끼군] [alpha:토끼군\:사랑해] [alpha\:beta:토끼군] %%%
[alpha\\:토끼군] [alpha:토끼군\사랑해] [alpha:토끼군\\사랑해] %%%
[alphanum:temp] [alphanum:temp&temp] [alphanum:temp%20temp] %%%
[alpha&beta] [temp?edit] -- 이건 그냥

! pre/tt 태그 테스트 ''(>= 0.1.-228)''
''0.1.-180에서 버그 수정''

이렇게 시작합니다.
{{
시작.
시작



으해해
}}
그렇게 끝났다.

또는 이렇게도 쓴다.

{{
시작
}}
시작 -- 이 부분은 pre 태그 안에 안 들어 가는 게 맞다.
}}

...-_-; 썰렁하군. {{이렇게}} 쓰는 게 정상. \{{죽어!}} 또는 {{그리고\}}저러고}} 락매니아

! \` 테스트 ''(>= 0.1.-243)''
-- 당연하지만 맨 처음에 `WikiWord라 써도 되어야 한다.

WikiWord`wikiXword`s -- 둘 다 따로 링크된다. %%%
WikiWord``wikiXword`s -- WikiWord는 링크되고 wikiXword는 escape %%%
WikiWord```wikiXword`s -- 정해져 있지 않음 %%%
wikiXword\`wikiXword -- 둘 다 링크되고 중간에 \` 등장 %%%
`WikiWord`QuoteIng -- WikiWord는 escape되고 QuoteIng은 따로 논다. %%%
`TestWikiWord 이렇게 할 수도 있다. %%%
그냥 \`TestWikiWord -_- \`\`\` and ``` 세 개만 나타난다.

! 줄 바꾸기 테스트 ''(>= 0.1.-260)''

줄 바꾼다. %%% 앗싸 잘 바뀐다.

다시 바꾼다. \%%% 이번엔 될 리가 없다. -_-

또 바꾼다. \\%%% 뭔가 붙지만 되긴 된다.
