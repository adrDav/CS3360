module Board where

 -- mkBaord n
 mkBoard n = mkBoardnxn n n
 mkBoardnxn n nn = [[0|x<-[1..n]]|x<-[1..nn]]

 -- mkPlayer
 mkPlayer = 1

 -- mkOpponent
 mkOpponent = 2

 -- size bd
 size bd = length bd

 -- row y bd
 row y bd 
  | y<1 || y>(size bd) = []
  | otherwise = bd !! (y-1)

 -- column x bd
 column x bd = [a !! (x-1) | a<-bd]

 -- mark x y bd p


 -- isEmpty x y bd
 isEmpty x y bd = ((row y bd) !! (x-1) == 0)

 -- isMarked x y bd
 isMarked x y bd = ((row y bd) !! (x-1) /= 0)

 -- isMarkedBy x y bd p
 -- marker x y board
 -- isFull bd
  isFull bd = length (filter (\x->x==0)(concat bd)) == 0

 -- isWonBy bd p
 -- isDraw bd
 -- isGameOver bd
 -- boardToStr playerToChar bd

