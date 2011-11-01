<?php exit; ?>
UHJldmlvdXNTeW50YXhQYXJzaW5n	4	YW5vbnltb3Vz	127.0.0.1	1078576805	
! 줄 바꾸기 테스트 ''(>= 0.1.-260)''

줄 바꾼다. %%% 앗싸 잘 바뀐다.

다시 바꾼다. \%%% 이번엔 될 리가 없다. -_-

또 바꾼다. \\%%% 뭔가 붙지만 되긴 된다.

! \` 테스트 ''(>= 0.1.-243)''
-- 당연하지만 맨 처음에 `WikiWord라 써도 되어야 한다.

WikiWord`wikiXword`s -- 둘 다 따로 링크된다. %%%
WikiWord``wikiXword`s -- WikiWord는 링크되고 wikiXword는 escape %%%
WikiWord```wikiXword`s -- 정해져 있지 않음 %%%
wikiXword\`wikiXword -- 둘 다 링크되고 중간에 \` 등장 %%%
`WikiWord`QuoteIng -- WikiWord는 escape되고 QuoteIng은 따로 논다. %%%
`TestWikiWord 이렇게 할 수도 있다. %%%
그냥 \`TestWikiWord -_- \`\`\` and ``` 세 개만 나타난다.

! pre/tt 태그 테스트 ''(>= 0.1.-228)''

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
시작
}}

...-_-; 썰렁하군. {{이렇게}} 쓰는 게 정상. \{{죽어!}} 또는 {{그리고\}}저러고}} 락매니아

! 인터위키 테스트 ''(>= 0.1.-219)''

[test:wiki] [alpha:beta] [alpha\:beta] [alpha\:beta:theta\:gamma] %%%
[alpha:토끼군] [alpha:토끼군\:사랑해] [alpha\:beta:토끼군] %%%
[alpha\\:토끼군] [alpha:토끼군\사랑해] [alpha:토끼군\\사랑해] %%%
[alphanum:temp] [alphanum:temp&temp] [alphanum:temp%20temp] %%%
[alpha&beta] [temp?edit] -- 이건 그냥

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

! link에서의 anchor 테스트 ''(>= 0.1.-201)''

[락매니아|토끼군] %%%
[[토끼집|http://tokigun.net/]] %%%
[[토끼집|tokigun.net]] %%%
[하나\|둘|셋\|넷] %%%
[하나\\|둘|셋\\|넷] %%%
[토끼군|wikiXnet:토끼군]

본의아니게 생긴 feature: [토끼군__바보다__그리고|토끼군]

! heading 테스트 ''(>= 0.1.-197)''

!! 둘 (하나는 이미 위에 있지?-_-;)
!!! 셋: 이건 h3 태그에 대응된다.
!!!! 넷: 이건 h4 태그에 대응된다.
!!!!! 다섯: 이건 h5 태그에 대응된다.
!!!!!! 여섯: 이건 h6 태그에 대응된다. 더 있을 턱이 없다;

:)
