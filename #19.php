<?php
        /**
         * @param int[] $array
         * @param int[] $subArray
         */
        function isInclude(array $array, array $subArray): bool
        {
            if(!$subArray) {
                return true;
            }

            $binarySearch = function(array $array, int $item): ?int
            {
                $start =-1;
                $end = count($array) - 1;

                while ( $end - $start > 0) {

                    $position = (int)ceil(($end + $start) / 2);

                    if ($array[$position] === $item) {
                        return $position;
                    }

                    if ($array[$position] < $item) {
                        if ($start === $position) {
                            return null;
                        }
                        $start = $position;
                    } else {
                        if ($end === $position) {
                            return null;
                        }
                        $end = $position;
                    }
                }

                return null;
            };

            $start = $binarySearch($array, $subArray[0]);
            $end = count($array) - 1;

            foreach ($subArray as $subArrayKey => $value) {
                $arrayKey = $start + $subArrayKey;
                if($arrayKey > $end || $array[$arrayKey] !== $value) {
                    return false;
                }
            }

            return true;

        }

        assert(isInclude([1, 2, 3, 5, 7, 9, 11], []) == true);
        assert(isInclude([1, 2, 3, 5, 7, 9, 11], [3, 5, 7]) == true);
        assert(isInclude([1, 2, 3, 5, 7, 9, 11], [4, 5, 7]) == false);
