<?php exit; ?>
d2lraVBsdWdpbkRldg==	1	YW5vbnltb3Vz	127.0.0.1	1080563884	
! wikiPlugin 관련 메모

wikiPlugin의 추후 개발 일정에 대한 내용입니다.

!! 플러그인 적용 위치

;__i.plugin.php__:
모든 파싱 전
;__r.plugin.php__:
syntax_linear 실행 직전 (블록 문법 빼고 나머지 문법이 실행되었을 경우)
;__l.plugin.php__:
syntax_linear 실행 직후. ''현재는 이것만 가능;''
;__o.plugin.php__:
최종 소스 출력 직전 (return 직전, 이 때는 \<?Plugin>이 \&lt;?Plugin\&gt;로 바뀌어 있는 상태이므로 정규표현식이 앞의 것과 사뭇-_- 다르게 된다.)
;__m.plugin.php__:
별도로 사용되는 모듈들. 모듈들은 단독적으로 사용되거나 다른 플러그인이 호출하는 라이브러리로 사용될 수 있다.
;__a.plugin.php__:
사용자 액션을 구현함.

i/r/l/o는 범위를 지정하기 위해서 ix/rx/lx/ox로 바꿔 쓸 수 있다. 이 경우 singleton 태그를 사용할 수 없으며 항상 \<?/Plugin> 태그가 있어야 한다. (아닐 경우 무시하고 파싱하지 않는다)