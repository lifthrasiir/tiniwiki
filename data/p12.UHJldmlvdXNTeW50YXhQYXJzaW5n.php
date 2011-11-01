<?php exit; ?>
UHJldmlvdXNTeW50YXhQYXJzaW5n	12	YW5vbnltb3Vz	127.0.0.1	1081321260	
! 정의 목록 테스트 ''(>= 0.1.-165)''

;바보:토끼군 // 이 줄은 정의목록으로 파싱
;바보\:토끼군 // :가 없어서 앞줄에 붙음
\;바보:토끼군 // 마찬가지
;바보:토끼군:토끼군 // 첫째 :만 인식
;바보\:토끼군:토끼군 // 둘째 :를 인식
;바보[alpha:metic]:우헤헤 // [...] 안의 :는 쪼개지지 말아야 함 (-_-;)
;;아하하<span style="color:red;">뻘갱이</span>:음... // HTML 태그 안의 :도 안 쪼개져야 함
;;바보:토끼군
;;;;;;바보:토끼군
;;바보:토끼군

;__토끼군__<p>바보</p>__우헤헤__:__락매냐__<p>무뇌충</p>__크하하하!__
;;;;__토끼군__<p>바보</p>__우헤헤__:__락매냐__<p>무뇌충</p>__크하하하!__
// 위의 줄에서 <p>와 </p> 주위로 적당히 닫고 여는 태그가 새로 생기면 정상-_-;

''이거 짜다가 새로 알게 된 버그:''
{{
__;;;\__토끼군\<p>바보\</p>진짜?\__:어쩌구__

이렇게 할 경우 b 태그가 끝나질 않는다. (..) 제길...
(젠장.. syntax_font 함수 정말 만들어야 하는 겐가..)
}}

---

! 엔티티 테스트 ''(>= 0.1.-168)''

이 프로그램의 이름은 &tiniwiki.name;이고 버전은 &tiniwiki.version;이며 (정확하게는 &tiniwiki.Version;) 만든 사람은 &tiniwiki.author;입니다.

이 곳에는 페이지가 무려 &npage;개, 그러니까 &npages;개, 다시 말해서 &nPages;개의 페이지가 있습니다.

이 페이지의 이름은 __&pagename;__입니다. 어쩌면 &pagename.asis;나 &PageName;일 지도 모르죠. 이 페이지의 주소는 &path;/&pagename.url;`이고 &path.host; 안에 있으며 저 위에 있는 로고 파일은 &path.theme;/logo.png`입니다.

이 페이지는 &author;가 만들었으며 &author.asis;로 출력되고 &path;/&author.url; 페이지에서 만날 수 있습니다.

당신은 &user;이며 아이피는 &userip;입니다.
// 0.1.-168 현재 &user; 지원 안 됨

이 페이지는 &version;번째 버전으로 전체 버전은 &Version;입니다. 또한 &mtime;에 고쳐졌고, &mTime;에 마지막으로 고쳐졌으며 &ctime;에 만들어졌습니다.
// 0.1.-168 현재 &Version;, &mTime;, &ctime; 지원 안 됨

오늘은 &yyyy;년 &m;월 &d;일 &h;시 &nn;분 &ss;초이며, &yyyy;/&mm;/&dd; &hh;:&nn;:&ss; 혹은 &now; 라고 짧게 줄입니다. (혹은 &today; 이렇게요...)

---

! listing 테스트 ''(>= 0.1.-168)''
''자세한 사항은 edit this page를 하면 볼 수 있습니당.''

// ul 태그에 대해서 level 테스트를 합니다.
* 하나
** 둘
*** 셋
********* 넷
*** 다섯
*** 여섯 // 다음 줄이 연결되어야 함
일곱
여덟 // 여기서 listing이 끝남

아홉
* 열 // ul, ol 태그가 섞였을 경우의 처리
# 열하나
* 열둘
# 열셋
* 열넷
## 열다섯
열다섯반
** 열여섯

> 열일곱 // blockquote 태그의 처리
>> 열여덟
>>> 열아홉
>>>> 스물
스물하나 // 이 아래의 pre 태그가 연결되어야 함.
{{
테스트
우헤헤
}}
원츄베베

> 다시금 환장
# 또 환장
* 또 환장... (뭐가?)

{{
테스트
* 테스트 // 이 두 줄은 파싱이 되지 않는다.
# 테스트
하나둘셋넷다섯여섯...

{{
다시 시작
}} // 여기서 pre 태그 끝
이건 안 된다!
}}

{{
하나
<p class="p">다시 하나</p> // 이 태그 전후로 pre 태그가 끝내져야 한다.
우리는 하나(..)
}}

---

! HTML 태그 파싱 테스트 ''(>= 0.1.-171)''

여기부터는 <b>굵게</b> 나옵니다.

<img src="/tiniwiki/theme/default/logo.png" /> 이미지가 나옵니다. %%%
<img src="/tiniwiki/theme/default/logo.png" width=60 height=35> XHTML에 맞지 않는 경우 자동으로 바뀌어 출력됩니다 (..) %%%
''지금 / 붙이는 것 빼고 다른 처리를 하지 않기 때문에, 위와 같이 ""가 빠졌다거나 checked 속성 같은 거의 처리가 참 환장할 노릇입니다. -_-;''
* <span style="font-weight:bold; color:red;">참고: 위의 문단은 img 태그에 alt 속성이 빠졌으므로 XHTML 1.1에 맞지 않는 문단입니다.</span>

<img src="/tiniwiki/theme/default/logo.png">토끼군</img> 이런 태그는 당근 불가능합니다. (</img>는 파싱되지 않습니다!)

WikiWord 같은 거의 영향을 받지 않는 지 테스트: <a href='about:blank' style=border:1px title="WikiWordTest: http://nzeo.com/ :)">우히히</a>

지정하지 않은 태그는 파싱되지 않습니다. <ins>앞뒤에 태그가 노출됩니다. 일명 누드 태그 :)</ins>

HTML 태그를 escape하는 방법은 두 가지 있습니다. &lt;b&gt;이렇게 하거나&lt;/b&gt; \<b>이렇게 합니다.\</b>

지금 가장 골때리는 게 block 태그의 처리입니다.
<h2 class="heading">이렇게 한다면 block은 깨지고 맙니다.</h2>
이런 사태를 예방하려면 아무래도 이런 태그들에 대해서 따로 태그 escape 옵션을 주도록 할 필요가 있습니다 (..)

<span style="text-decoration:underline;">마지막 해결 방법: html 플러그인 만들고 범위 줘서 하라고 하게 함 (......)</span>

---

! 한 번 더 WikiWord 테스트 ''(ONLY 0.1.-180/beta14)''

{{
TiniWiki`AlphaBet -- 둘 다 링크
TiniWiki``AlphaBet -- 뒤에 링크 안 됨
`TiniWiki`AlphaBet -- 앞에 링크 안 됨
$`AlphaBet -- 링크 안 됨 (0.1.-180 전까지는 링크가 되었었다...)
}}

---

! heading 테스트 ''(>= 0.1.-197)''

!! 둘 (하나는 이미 위에 있지?-_-;)
!!! 셋: 이건 h3 태그에 대응된다.
!!!! 넷: 이건 h4 태그에 대응된다.
!!!!! 다섯: 이건 h5 태그에 대응된다.
!!!!!! 여섯: 이건 h6 태그에 대응된다. 더 있을 턱이 없다;

:)

---

! link에서의 anchor 테스트 ''(>= 0.1.-201)''

[락매니아|토끼군] %%%
[[토끼집|http://tokigun.net/]] %%%
[[토끼집|tokigun.net]] %%%
[하나\|둘|셋\|넷] %%%
[하나\\|둘|셋\\|넷] %%%
[토끼군|wikiXnet:토끼군]

본의아니게 생긴 feature: [토끼군__바보다__그리고|토끼군]

---

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

---

! 인터위키 테스트 ''(>= 0.1.-219)''

[test:wiki] [alpha:beta] [alpha\:beta] [alpha\:beta:theta\:gamma] %%%
[alpha:토끼군] [alpha:토끼군\:사랑해] [alpha\:beta:토끼군] %%%
[alpha\\:토끼군] [alpha:토끼군\사랑해] [alpha:토끼군\\사랑해] %%%
[alphanum:temp] [alphanum:temp&temp] [alphanum:temp%20temp] %%%
[alpha&beta] [temp?edit] -- 이건 그냥

---

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

---

! \` 테스트 ''(>= 0.1.-243)''
-- 당연하지만 맨 처음에 `WikiWord라 써도 되어야 한다.

WikiWord`wikiXword`s -- 둘 다 따로 링크된다. %%%
WikiWord``wikiXword`s -- WikiWord는 링크되고 wikiXword는 escape %%%
WikiWord```wikiXword`s -- 정해져 있지 않음 %%%
wikiXword\`wikiXword -- 둘 다 링크되고 중간에 \` 등장 %%%
`WikiWord`QuoteIng -- WikiWord는 escape되고 QuoteIng은 따로 논다. %%%
`TestWikiWord 이렇게 할 수도 있다. %%%
그냥 \`TestWikiWord -_- \`\`\` and ``` 세 개만 나타난다.

---

! 줄 바꾸기 테스트 ''(>= 0.1.-260)''

줄 바꾼다. %%% 앗싸 잘 바뀐다.

다시 바꾼다. \%%% 이번엔 될 리가 없다. -_-

또 바꾼다. \\%%% 뭔가 붙지만 되긴 된다.
