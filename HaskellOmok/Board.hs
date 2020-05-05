module Board where
--1.
 -- mkBoard: Receives as input an integer n and returns an empty nxn board as the [[Int]] type.
 mkBoard n = mkBoardnxn n n
 mkBoardnxn n nn = [[0|x<-[1..n]]|x<-[1..nn]]

 -- mkPlayer: Object of type Int, mkPlayer represents the human player.
 mkPlayer :: Int
 mkPlayer = 1

 -- mkOpponent: Object of type Int, mkOpponent represents the computer player.
 mkOpponent :: Int
 mkOpponent = 2

 -- size bd: Receives the board ( [[Int]] ) and returns the length of such object.
 size :: [[Int]]-> Int
 size bd =  length bd

 -- row y bd: Receives an integer y, where y represents a 1-based index. Returns the list of coordinates of the row.
 row :: Int -> [[Int]] -> [Int]
 row y bd 
  | y<1 || y>(size bd) = []
  | otherwise = bd !! (y-1)


 -- column x bd: Receives an integer x, where x represents a 1-based index. Returns the list of coordinates of the column.
 column :: Int -> [[Int]] -> [Int]
 column x bd = [a !! (x-1) | a<-bd] 

 markRow 1 (h:t) p = (m:t)
  where m = if h==0 then p else h
 markRow n (h:t) p = h : markRow (n-1) t p

 --2.
 -- mark x y bd p: Receives two integers y and x along with the board, marks the board with the player´s stone. Returns the marked board.
 mark :: Int -> Int -> [[Int]] -> Int -> [[Int]]
 mark 1 y (h:t) p = markRow y h p : t
 mark x y (h:t) p = h:mark (x-1) y t p

 -- isEmpty x y bd: Receives two integers y and x along with the board, returns a boolean stating if there is a stone placed by either player in the location.
 isEmpty :: Int -> Int -> [[Int]] -> Bool
 isEmpty x y bd = ((row y bd) !! (x-1) == 0)

 -- isMarked x y bd
 --isMarked x y bd = ((row y bd) !! (x-1) /= 0)

 -- isMarkedBy x y bd p

 -- marker x y board
 
 isFullRow [] = True
 isFullRow (h:t) = h/=0 && isFullRow t
 -- isFull bd: Receives the board and returns a boolean stating whether there´s a space left in the board to place a stone.
 isFull :: [[Int]] -> Bool
 isFull [] = True
 isFull (h:t) = isFull t && isFullRow h



--3.
 -- isWonBy bd p
 -- isDraw bd
 -- isGameOver bd
 -- boardToStr playerToChar bd
 

