<?php exit; ?>
Q2hhbmdlTG9n	2	YW5vbnltb3Vz	127.0.0.1	1078501821	
!!!! version 0.1.-180 ''(2004/03/05?)''
- 드디어(..) page history 기능 지원! %%%
- netlink에서 엄청난 실수를 바로 잡음. a 태그가 두 번 묶이는 경우가 발생할 수 있다. %%%
- &amp;nbsp;, &amp;tiniwiki.Version;, &amp;pagename;, &amp;version;, &amp;author; 등의 엔티티 추가. (...)
!!!!!! plugin: AllPages version 0.09
- 디자인 조금 바꾸고 파일 구조 바뀐 거에 따라 수정.
!!!!!! plugin: WikiEgg version 0.02
- 이스터 에그(..) 격의 플러그인 :)
!!!!!! theme: TiniWikiDefault version 0.11
- 스타일 시트를 조금 변경하였다. 제목에 색깔 들어 간다 :) %%%
- 아이콘을 집어 넣었다.

---

!!!! version 0.1.-187b
- 파일 구조 확정. 이름 체계 바꾸다.
!!!!!! plugin: AllPages version 0.08b
- 이름 체계 바뀐 거에 맞춰서 프로그램 고치고 플러그인 포맷 조금 바꿈.

!!!! version 0.1.-187 ''(2004/03/03)''
- entity parsing 기능 추가. tiniwiki.version과 세 개의 HTML entity를 집어 넣었다. 무시할 때는 &amp;tiniwiki.version;이나 \&tiniwiki.version; 이렇게 하면 된다 :)

!!!! version 0.1.-189
- 아니다. netlink 안 고쳤다. 고쳐 놓고 보니까 \\가 anchor에 들어 있을 경우의 해결책이 상당히 혼잡스러운데, 나중에 고치자. 귀찮아 죽겠다.

!!!! version 0.1.-190 ''(2004/03/02)''
- bracket link가 한 줄에 둘 이상 있을 때 anchor가 달린 것이 있을 경우 링크가 잘못 해석 되는 문제를 해결. 하는 김에 syntax_link 함수를 확 뒤엎어서 좀 더 빠르고 깔끔하게 고쳤다. link는 이제 끝! 'ㅡ')/ %%%
- 테마 기능 추가. (덤으로 모든 태그에 class 추가)
!!!!!! theme: TiniWikiDefault version 0.1
- 첫번째 TiniWiki 테마 :)

!!!! version 0.1.-196 ''(2004/03/01)''
- syntax_parsing 함수 고침. 자동으로 줄 구분 문자 인식해서 그걸로 쭉 밀고(..) 나간다.

!!!! version 0.1.-197
- heading 기능 추가. 아직 목차 기능 구현 안 했다.

!!! version 0.1.-200
- link의 anchor 부분에 존재하는 버그 해결. 진짜로 0.1.-2xx 대의 마지막 버전.

!!!! version 0.1.-201
- 0.1.-2xx 대의 마지막 버전''(이라고 생각했다)''. |를 사용해서 링크의 anchor를 바꿀 수 있다.

!!!! version 0.1.-207
- 파일명 지정 방법 변경....했다가 다시 고쳤다. -_-;
!!!!!! plugin: AllPages version 0.08a
- 파일명 지정 방법 변경.

!!!! version 0.1.-209
- netlink 기능 추가!!! 삽질 끝에 syntax_escape() 함수의 버그 발견 -_-; %%%
- syntax_escape(): $``netLink 변수 앞에는 \`가 아니라 \`\`를 붙이게 바꿈. %%%
- \`의 기능 확정. 단어 중간의 \`는 무조건 split이다. escape는 \`\`를 써야 한다.

!!!! version 0.1.-215 ''(2004/02/29)''
- 한 줄에 ---만 넣으면 줄이 그어진다.

!!!! version 0.1.-217
- 플러그인을 별도의 파일로 분리함.

!!!! version 0.1.-219
- 인터위키 기능 작동. 문제 있을 수 있으므로 좀 테스트 해 봐야 한다. --> 현재 정상 작동 중

!!!! version 0.1.-228
- 드디어-_- <pre> 태그와 <tt> 태그가 작동한다! %%%
- _elaspedtime() 함수 추가. 시간 대충 봤는데 아직까진 괜찮다. 0.00x초 단위니.

!!!! version 0.1.-240
- 문단 별로 <p>가 나뉘게 고침. -_-

!!!! version 0.1.-241
- base64_encode()를 쓰던 페이지 저장 방식을 rawurlencode()로 변경

!!!! version 0.1.-243
- 약간의 개삽질로 \`로 escape하는 기능이 작동하기 시작.

!!!! version 0.1.-260
- \%%%가 작동한다!

!!!! version 0.1.-263
- 플러그인 기능 추가.
!!!!!! plugin: AllPages version 0.08
- AllPages 플러그인 심심해서 추가(..)

!!!! version 0.1.-269
- ''기울게'', __굵게__, [링크] 기능 작동. %%%
- \\를 사용한 escape 작동

!!! version 0.1.-300 ''(2003/02/28)''
- 개발 시작. 뼈대만 붙여 놓고 있다.
